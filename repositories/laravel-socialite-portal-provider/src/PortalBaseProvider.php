<?php

namespace Ncucc\Portal;

use GuzzleHttp\ClientInterface;
use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class PortalBaseProvider extends AbstractProvider implements ProviderInterface
{
    const PORTAL_BASE_URL = 'https://portal.ncu.edu.tw';

    protected $scopeSeparator = ' ';

    protected $scopes = [
	    'identifier',
	    'chinese-name', 'english-name',
	    'gender', 'birthday',
	    'personal-id',
	    'student-id',
	    'faculty-records' ,
	    'academy-records',
	    'email',
	    'mobile-phone',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(self::PORTAL_BASE_URL . '/oauth2/authorization', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return self::PORTAL_BASE_URL . '/oauth2/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token): array
    {
        $userUrl = self::PORTAL_BASE_URL . '/apis/oauth/v1/info';

        $response = $this->getHttpClient()->get($userUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return (array) json_decode($response->getBody(), true);
    }

    /**
     * Get the access token response for the given code.
     *
     * @param  string  $code
     * @return array
     */
    public function getAccessTokenResponse($code): array
    {
        $postKey = (version_compare(ClientInterface::MAJOR_VERSION, '6') === 1) ? 'form_params' : 'body';

        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'auth' => [$this->clientId, $this->clientSecret],
            'headers' => ['Accept' => 'application/json'],
            $postKey => $this->getTokenFields($code),
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user): User
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['identifier'],
            'name' => Arr::get($user, 'chinese_name'),
            'email' => Arr::get($user, 'email'),
            'verified_email' => Arr::get($user, 'email_verified'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code): array
    {
        return parent::getTokenFields($code) + ['grant_type' => 'authorization_code'];
    }
}
