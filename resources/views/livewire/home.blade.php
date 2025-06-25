<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $title }}</h1>
            <p class="text-xl text-gray-600">{{ $description }}</p>
        </div>

        <!-- Counter Section -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Bộ đếm tương tác</h2>
            <div class="flex items-center justify-center space-x-6">
                <button wire:click="decrement" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    -
                </button>
                <div class="text-4xl font-bold text-gray-800 min-w-[80px] text-center">
                    {{ $count }}
                </div>
                <button wire:click="increment" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                    +
                </button>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="text-blue-500 text-3xl mb-4">🚀</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Hiệu suất cao</h3>
                <p class="text-gray-600">Livewire cung cấp trải nghiệm người dùng mượt mà với ít JavaScript</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="text-green-500 text-3xl mb-4">⚡</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Phát triển nhanh</h3>
                <p class="text-gray-600">Tạo ứng dụng động mà không cần viết nhiều JavaScript</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="text-purple-500 text-3xl mb-4">🛠️</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Dễ sử dụng</h3>
                <p class="text-gray-600">Cú pháp đơn giản và trực quan cho các tương tác</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12">
            <p class="text-gray-500">Được xây dựng với Laravel và Livewire</p>
        </div>
    </div>
</div>
