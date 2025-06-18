<div class="relative w-full min-h-screen flex flex-col items-center justify-center overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <!-- Top left floating elements -->
            <div class="floating-ui bg-blue-100 w-48 h-36 left-[5%] top-[15%] animate-float-left">
                <div class="p-4">
                    <div class="w-full h-4 bg-blue-200 rounded mb-2"></div>
                    <div class="w-3/4 h-4 bg-blue-200 rounded mb-4"></div>
                    <div class="flex space-x-2">
                        <div class="w-8 h-8 bg-blue-300 rounded"></div>
                        <div class="w-8 h-8 bg-blue-300 rounded"></div>
                        <div class="w-8 h-8 bg-blue-300 rounded"></div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom left floating elements -->
            <div class="floating-ui bg-gray-100 w-40 h-40 left-[8%] bottom-[10%] animate-float">
                <div class="p-3">
                    <div class="w-full h-6 bg-gray-200 rounded mb-2"></div>
                    <div class="w-full h-24 bg-gray-200 rounded"></div>
                </div>
            </div>
            
            <!-- Center left floating element -->
            <div class="floating-ui bg-purple-100 w-36 h-20 left-[20%] top-[40%] animate-float-left">
                <div class="p-2 flex items-center justify-center h-full">
                    <div class="w-12 h-12 bg-purple-300 rounded-full flex items-center justify-center">
                        <span class="text-purple-700 font-bold">Q</span>
                    </div>
                </div>
            </div>
            
            <!-- Top right floating elements -->
            <div class="floating-ui bg-green-100 w-52 h-40 right-[8%] top-[20%] animate-float-right">
                <div class="p-4">
                    <div class="w-full h-4 bg-green-200 rounded mb-2"></div>
                    <div class="w-full h-24 bg-green-200 rounded"></div>
                    <div class="mt-2 w-8 h-8 bg-yellow-300 rounded-full"></div>
                </div>
            </div>
            
            <!-- Bottom right floating elements -->
            <div class="floating-ui bg-purple-100 w-44 h-32 right-[15%] bottom-[15%] animate-float">
                <div class="p-3">
                    <div class="w-full h-5 bg-purple-200 rounded mb-2"></div>
                    <div class="w-3/4 h-5 bg-purple-200 rounded mb-3"></div>
                    <div class="flex">
                        <div class="w-20 h-10 bg-purple-300 rounded flex items-center justify-center">
                            <span class="text-xs text-purple-700">LESSONS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Hero Content -->
        <div class="container mx-auto px-4 z-10 text-center">
            <div class="max-w-3xl mx-auto mb-20">
                <div class="mb-6">
                    <h2 class="text-xl text-quiz-dark md:text-2xl mb-1">
                        Discover our <span class="text-blue-light">Collaborative Serious Game</span>
                    </h2>
                    
                    <h1 class="text-4xl text-quiz-dark md:text-6xl font-bold mb-4">
                        "I had no idea PlayLearn could do that."
                    </h1>
                    
                    <p class="text-gray-500 text-lg">
                        - Almost everybody
                    </p>
                </div>
            
                <div class="h-px w-full bg-gray-200 my-8"></div>
                
                <p class="text-xl md:text-2xl text-gray-700 mb-10"> 
                    Configure and deliver a complete educational game<br>experience tailored to each student’s needs in logistics and industry.
                </p>
                
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <button class="btn-primary flex items-center gap-2">
                        <a href="{{ route('register')}}">Get started</a>
                    </button>
                    
                    <button class="btn-secondary flex items-center gap-2">
                        <span>Learn more</span>
                        <span>→</span>
                    </button>
                </div>
            </div>
        </div>
</div>