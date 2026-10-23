<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(Role $role, string $email): User
    {
        $user = new User();
        $user->forceFill([
            'name_zh' => '測試',
            'name_en' => 'Test',
            'email'   => $email,
            'role'    => $role->value,
        ])->save();

        return $user;
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name_zh'  => '新名字',
            'name_en'  => 'New Name',
            'nickname' => '小新',
            'phone'    => '0912-345-678',
            'email'    => 'new@example.com',
        ], $overrides);
    }

    public function test_member_can_update_own_profile(): void
    {
        $member = $this->makeUser(Role::MEMBER, 'member@example.com');

        $this->actingAs($member)
            ->put(route('user.update', $member->id), $this->payload())
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertSame('new@example.com', $member->fresh()->email);
        $this->assertSame('新名字', $member->fresh()->name_zh);
    }

    public function test_member_cannot_update_another_users_profile(): void
    {
        $member = $this->makeUser(Role::MEMBER, 'member@example.com');
        $victim = $this->makeUser(Role::CLUB_LEADER, 'leader@example.com');

        $this->actingAs($member)
            ->put(route('user.update', $victim->id), $this->payload(['email' => 'member-portal@example.com']))
            ->assertForbidden();

        $this->assertSame('leader@example.com', $victim->fresh()->email);
    }

    public function test_member_cannot_view_another_users_edit_page(): void
    {
        $member = $this->makeUser(Role::MEMBER, 'member@example.com');
        $other = $this->makeUser(Role::MEMBER, 'other@example.com');

        $this->actingAs($member)
            ->get(route('user.edit', $other->id))
            ->assertForbidden();
    }

    public function test_officer_can_edit_another_users_profile(): void
    {
        $leader = $this->makeUser(Role::CLUB_LEADER, 'leader@example.com');
        $member = $this->makeUser(Role::MEMBER, 'member@example.com');

        $this->actingAs($leader)
            ->get(route('user.edit', $member->id))
            ->assertOk();

        $this->actingAs($leader)
            ->put(route('user.update', $member->id), $this->payload())
            ->assertSessionHasNoErrors();

        $this->assertSame('new@example.com', $member->fresh()->email);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $member = $this->makeUser(Role::MEMBER, 'member@example.com');

        $this->put(route('user.update', $member->id), $this->payload())
            ->assertRedirect();

        $this->assertSame('member@example.com', $member->fresh()->email);
    }

    public function test_email_with_crlf_is_rejected(): void
    {
        $member = $this->makeUser(Role::MEMBER, 'member@example.com');

        $this->actingAs($member)
            ->put(route('user.update', $member->id), $this->payload(['email' => "a@example.com\r\nBcc: x@evil.test"]))
            ->assertSessionHasErrors('email');

        $this->assertSame('member@example.com', $member->fresh()->email);
    }

    public function test_email_already_used_by_another_user_is_rejected(): void
    {
        $member = $this->makeUser(Role::MEMBER, 'member@example.com');
        $this->makeUser(Role::MEMBER, 'taken@example.com');

        $this->actingAs($member)
            ->put(route('user.update', $member->id), $this->payload(['email' => 'taken@example.com']))
            ->assertSessionHasErrors('email');
    }

    public function test_keeping_own_email_passes_unique_check(): void
    {
        $member = $this->makeUser(Role::MEMBER, 'member@example.com');

        $this->actingAs($member)
            ->put(route('user.update', $member->id), $this->payload(['email' => 'member@example.com']))
            ->assertSessionHasNoErrors();
    }

    public function test_required_fields_and_phone_format_are_validated(): void
    {
        $member = $this->makeUser(Role::MEMBER, 'member@example.com');

        $this->actingAs($member)
            ->put(route('user.update', $member->id), $this->payload(['name_zh' => '', 'phone' => '<script>']))
            ->assertSessionHasErrors(['name_zh', 'phone']);
    }
}
