<div>
{{--     <nav class="fixed top-0 left-0 right-0 bg-transparent z-50 px-4 py-2">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-white text-2xl font-bold">PlayLearn</div>
            <div class="flex gap-4">
                <button class="text-white hover:bg-white/10 px-4 py-2 rounded-lg transition-colors">
                Mon tableau de bord
                </button>
            </div>
        </div>
    </nav> --}}

    <main class="flex flex-col items-center justify-center min-h-screen px-4">
        <div class="text-center mb-12">
            <h1 class="text-[#2157ef] text-6xl font-bold mb-8">PlayLearn</h1>
        </div>

        <!-- Join Form -->
        <form wire:submit.prevent="joinSession" class="w-full max-w-md">
            <div class="flex gap-2">
                <input
                    type="text"
                    wire:model="membership_code"
                    placeholder="Saisissez un code d'adhésion"
                    class="flex-1 px-4 py-2 bg-white text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button
                    type="submit"
                    class="bg-[#5d9cfd] text-white px-6 py-2 rounded-lg hover:bg-[#2157ef] transition-colors"
                >
                    Joindre
                </button>
            </div>
        </form>
    </main>
</div>
