<div class="min-h-screen bg-green-700 flex flex-col items-center justify-center py-8 px-2">
    <div class="w-full max-w-md mx-auto">
        <!-- Banner -->
        <div class="mb-6 flex justify-center">
            <img src="/cao-atiso-nuoc-da-lat.jpg" alt="Banner" class="rounded-2xl shadow-lg w-full object-cover h-40" />
        </div>

        <!-- Glass Card Form -->
        <div class="glass-card p-8 rounded-2xl shadow-2xl animate-slide-in-up bg-white  backdrop-blur-md">
            <div class="text-center mb-8">
                <div class="relative inline-block">
                    <h1 class="text-2xl font-bold text-[#002169] mb-2">Bắt đầu quay thưởng</h1>
                    <div class="absolute -bottom-1 left-0 right-0 h-0.5 bg-[#FFDE59] rounded-full"></div>
                </div>
                <p class="text-gray-600 mt-4">Điền đầy đủ thông tin trước khi quay thưởng Cao Atiso nhé.</p>
            </div>
            @if ($successMessage)
                <div class="mb-4 p-3 rounded-xl bg-green-100 text-green-800 text-center font-semibold">{{ $successMessage }}</div>
            @endif
            @if ($errorMessage)
                <div class="mb-4 p-3 rounded-xl bg-red-100 text-red-800 text-center font-semibold">{{ $errorMessage }}</div>
            @endif
            <form class="space-y-6" wire:submit.prevent="submit">
                <div class="space-y-3">
                    <label class="text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-[#002169] font-semibold" for="name">Họ tên</label>
                    <input type="text" wire:model.defer="name" class="flex w-full bg-background py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm border-2 border-gray-200 focus:border-[#FFDE59] focus:ring-2 focus:ring-[#FFDE59]/20 rounded-xl h-12 px-4 transition-all duration-300 hover:border-[#FFDE59]/50" id="name" placeholder="Nhập họ tên của bạn" required />
                    @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="space-y-3">
                    <label class="text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-[#002169] font-semibold" for="phone">Số điện thoại</label>
                    <input type="tel" wire:model.defer="phone" class="flex w-full bg-background py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm border-2 border-gray-200 focus:border-[#FFDE59] focus:ring-2 focus:ring-[#FFDE59]/20 rounded-xl h-12 px-4 transition-all duration-300 hover:border-[#FFDE59]/50" id="phone" placeholder="Nhập số điện thoại" required />
                    @error('phone') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="space-y-3">
                    <label class="text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-[#002169] font-semibold" for="email">Email <span class="text-gray-400 text-sm ml-2">(tùy chọn)</span></label>
                    <input type="email" wire:model.defer="email" class="flex w-full bg-background py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm border-2 border-gray-200 focus:border-[#FFDE59] focus:ring-2 focus:ring-[#FFDE59]/20 rounded-xl h-12 px-4 transition-all duration-300 hover:border-[#FFDE59]/50" id="email" placeholder="Nhập email (không bắt buộc)" />
                    @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div>
                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-700 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-green-700 hover:bg-green-800 px-4 py-2 w-full reward-button text-white font-bold h-14 text-lg rounded-xl shadow-lg transition-all duration-300" type="submit">
                        <div class="flex items-center justify-center">Tiến hành quay thưởng
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right ml-2 h-5 w-5"><path d="m9 18 6-6-6-6"></path></svg>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
