<div>
    <div class="mb-6 mt-3">
        <form class="container grid grid-cols-2 gap-3"  wire:submit="createOrder">
            <div class="customer-info">
                <div class="heading flex flex-row gap-2 pb-4 border-b border-gray-200 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <span>
                        Thông tin của bạn
                    </span>
                </div>
                <div class="persenal-details mb-3 border-b border-gray-200">
                    <div class="form-input flex flex-row items-center gap-4 mb-3">
                        <label class="flex-1/5 font-medium" for="" >Họ và tên: </label>
                        <input type="text" placeholder="Nhập họ và tên" class="input grow" wire:model="customerName" />

                    </div>
                        @error('customerName')
                            <span class="block text-red-500"> {{ $message }} </span>
                        @enderror
                    <div class="form-input flex flex-row items-center gap-4 mb-3">
                        <label class="flex-1/5 font-medium" for="">Số điện thoại: </label>
                        <input type="text" placeholder="Nhập số điện thoại" class="input grow" wire:model="phoneNumber"/>
                    </div>
                     @error('phoneNumber')
                            <span class="block text-red-500"> {{ $message }} </span>
                        @enderror
                    <div class="form-input flex flex-row items-center gap-4 mb-3">
                        <label class="flex-1/5 font-medium" for="">Chọn tỉnh / thành phố: </label>
                        <select class="select grow" wire:model="city">
                            <option disabled selected>Vui lòng chọn tỉnh thành phố</option>
                            <option>Crimson</option>
                            <option>Amber</option>
                            <option>Velvet</option>
                        </select>
                    </div>
                </div>
                <div class="note mb-3 border-b border-gray-200">
                    <div class="form-input gap-4 mb-3">
                        <label class="font-medium block mb-3" for="" >Lưu ý: </label>
                        <textarea class="textarea resize-none w-full" placeholder="Viết lưu ý cho shop" wire:model="note"></textarea>
                    </div>
                </div>
                <div class="method-to-pay">
                    <div class="form-input gap-4 mb-3">
                        <span class="font-medium block mb-3" for="" >Phương thức thanh toán: </span>
                        <input id="pay-by-cash" type="radio" name="radio-1" class="radio radio-xs" checked="checked" /> <label for="pay-by-cash">Thanh toán bằng tiền mặt</label>
                    </div>
                </div>
            </div>
            <div class="order">
                <div class="heading flex flex-row gap-2 pb-4 border-b border-gray-200 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span>
                        Thông tin giỏ hàng
                    </span>
                </div>
                <div class="order-detail mb-3 border-b border-gray-200 pb-4">
                    <ul class="list bg-base-100 rounded-box shadow-md">
                        @foreach ($items as $item)
                             <li class="list-row">
                            <div><img class="size-10 rounded-box" src="{{ Storage::url($item->avatar->path ?? 'photos/sample_product.webp') }}"/></div>
                            <div>
                            <div></div>
                            <div class="text-xs uppercase font-semibold">{{ $item['name'] }}</div>
                            </div>
                            <div class="form-input flex flex-row">
                                <div class="join">
                                <button type="button" class="btn btn-neutral join-item" wire:click="decrease('{{ $item['id'] }}')">-</button>
                                <div>
                                    <label class="input validator join-item w-10">
                                      <input type="number"  wire:model="quantities.{{ $item['id'] }}"/>
                                    </label>
                                </div>
                                <button type="button" class="btn btn-neutral join-item" wire:click="increase('{{ $item['id'] }}')">+</button>
                                </div>
                            </div>
                            <button class="btn btn-square btn-ghost" type="button" wire:click="remove('{{ $item['id'] }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="total-price flex flex-row items-center justify-between mb-3 border-b border-gray-200 pb-4">
                    <span>Tổng tiền: </span>
                    <span class="font-bold text-red-500">{{ number_format($totalPrice, 0, ',', '.')  }} VND</span>
                </div>
                <div class="confirm-order">
                    <div class="form-input text-center">
                        <button class="btn bg-lime-600 p-8"  @if (!$items)
                            disabled
                        @endif >
                            <div >
                                <span class="font-bold text-white text-2xl block">Đặt hàng</span>
                                <p class="text-white">Shop sẽ gọi lại cho quý khách</p>
                            </div>
                        </button>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div x-data="{ show: true }" x-show="show"
                        class="p-3 mt-4 mb-4 text-green-800 bg-green-100 rounded-lg transition-opacity duration-500">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
