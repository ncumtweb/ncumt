<div>
    <!-- 搜尋和篩選器 -->
    <div class="filter-container mb-3 flex-row d-flex flex-wrap align-items-center">
        <!-- 路線名稱搜尋 -->
        <div class="flex-grow-1 ms-2 d-flex justify-content-start">
            <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="搜尋路線名稱..."
                   class="form-control-sm search-input mt-2">
        </div>
        <!-- 隊伍難度篩選 -->
        <div class="flex-grow-1 me-2 d-flex justify-content-end">
            <select wire:model="selectedLevel" class="form-control-sm mt-2">
                <option value="">選擇難度等級</option>
                @foreach($result_levelArray as $level)
                    <option value="{{ $level }}">{{ $level }} </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- 紀錄 -->
    <div class="col-md-12 text-center table-responsive">
        @if($judgements->isEmpty())
            <div class="col-lg-12 text-center">
                <h2>目前沒有隊伍難度評分紀錄</h2>
            </div>
        @else
            <table class="table table-light table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">路線名稱</th>
                    <th scope="col">總天數</th>
                    <th scope="col" class="hide-mobile">傳統路</th>
                    <th scope="col" class="hide-mobile">非傳統路</th>
                    <th scope="col" class="hide-mobile">路線</th>
                    <th scope="col" class="hide-mobile">路標</th>
                    <th scope="col" class="hide-mobile">地形</th>
                    <th scope="col" class="hide-mobile">植被</th>
                    <th scope="col" class="hide-mobile">體力</th>
                    <th scope="col" class="hide-mobile">背水天數</th>
                    <th scope="col">難度總分</th>
                    <th scope="col">隊伍難度</th>
                    <th scope="col" class="show-mobile">info</th>
                    <!-- 幹部才能編輯 -->
                    @auth
                        @if(Auth::user()->role > 0)
                            <th scope="col" class="hide-mobile">編輯/刪除</th>
                        @endif
                    @endauth
                </tr>
                </thead>
                <tbody>
                @foreach($judgements as $judgement)
                    <tr wire:key="judgementPage-{{ $judgement->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        @if ($judgement->trip_tag == 0)
                            <td>{{ $judgement->name }}</td>
                        @elseif ($judgement->trip_tag == 1)
                            <td>{{ $judgement->name }} <span style="color:red">(壓縮行程)</span></td>
                        @elseif ($judgement->trip_tag == 2)
                            <td>{{ $judgement->name }} <span style="color:green">(寬鬆行程)</span></td>
                        @endif
                        <td>{{ $judgement->normal_day + $judgement->abnormal_day}}</td>
                        <td class="hide-mobile">{{ $judgement->normal_day }} 天</td>
                        <td class="hide-mobile">{{ $judgement->abnormal_day }} 天</td>
                        <td class="hide-mobile">{{ $levelArray[$judgement->level] }}</td>
                        <td class="hide-mobile">{{ $judgement->road }} 分</td>
                        <td class="hide-mobile">{{ $judgement->terrain }} 分</td>
                        <td class="hide-mobile">{{ $judgement->plant }} 分</td>
                        <td class="hide-mobile">{{ $judgement->energy }}</td>
                        <td class="hide-mobile">{{ $judgement->water }} 天</td>
                        <td>{{ $judgement->score }} 分</td>
                        <td>{{ $judgement->result_level }}</td>
                        <td class="show-mobile">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal-{{ $judgement->id }}">
                                info
                            </button>
                        </td>
                        @auth
                            @if(Auth::user()->role > 0)
                                <td class="hide-mobile">
                                    <button type="button" class="bi bi-pencil-square"
                                            onclick="window.location='{{ route('judgement.edit', $judgement->id) }}'"></button>
                                    <button type="button" class="bi bi-trash"
                                            onclick="confirmDelete('是否確定要刪除這則評分紀錄？')"
                                            wire:click="deleteJudgement({{ $judgement->id }})"></button>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @endforeach
                </tbody>
            </table>
                        @foreach($judgements as $judgement)
                <div class="modal fade" id="modal-{{ $judgement->id }}" tabindex="-1"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div
                                class="modal-header d-flex justify-content-center align-items-center position-relative">
                                <h5 class="modal-title" id="exampleModalLabel">詳細資料</h5>
                                <button type="button" class="btn-close position-absolute" style="right: 1rem;"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-light table-bordered table-striped mobile-table">
                                    <tbody>
                                    <tr>
                                        <th scope="row">#</th>
                                        <td>{{ $loop->index + 1 }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">路線名稱</th>
                                        @if ($judgement->trip_tag == 0)
                                            <td>{{ $judgement->name }}</td>
                                        @elseif ($judgement->trip_tag == 1)
                                            <td>{{ $judgement->name }} <span style="color:red">(壓縮行程)</span></td>
                                        @elseif ($judgement->trip_tag == 2)
                                            <td>{{ $judgement->name }} <span style="color:green">(寬鬆行程)</span></td>
                                        @endif</tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">總天數</th>
                                        <td>{{ $judgement->normal_day + $judgement->abnormal_day}}</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">傳統路</th>
                                        <td>{{ $judgement->normal_day }} 天</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">非傳統路</th>
                                        <td>{{ $judgement->abnormal_day }} 天</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">路線</th>
                                        <td>{{ $levelArray[$judgement->level] }}</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">路標</th>
                                        <td>{{ $judgement->road }} 分</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">地形</th>
                                        <td>{{ $judgement->terrain }} 分</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">植被</th>
                                        <td>{{ $judgement->plant }} 分</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">體力</th>
                                        <td>{{ $judgement->energy }}</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">背水天數</th>
                                        <td>{{ $judgement->water }} 天</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">難度總分</th>
                                        <td>{{ $judgement->score }} 分</td>
                                    </tr>
                                    <tr wire:key="judgementPage-modal-{{ $judgement->id }}">
                                        <th scope="row">隊伍難度</th>
                                        <td>{{ $judgement->result_level }}</td>
                                    </tr>
                                    <tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                @auth
                                    @if(Auth::user()->role > 0)
                                        <button type="button" class="bi bi-pencil-square"
                                                onclick="window.location='{{ route('judgement.edit', $judgement->id) }}'"></button>
                                        <button type="button" class="bi bi-trash"
                                                onclick="confirmDelete('是否確定要刪除這則評分紀錄？')"
                                                wire:click="deleteJudgement({{ $judgement->id }})"></button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                        @endforeach
            <div class="d-flex justify-content-center">
                {{ $judgements->links() }}
            </div>
        @endif
    </div>
</div>
