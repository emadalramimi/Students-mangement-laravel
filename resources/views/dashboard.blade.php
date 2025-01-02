<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">Total Modules</div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ count($modules) }}</div>
                            </div>
                            <i class="fas fa-cubes text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">Total Students</div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $eleves }}</div>
                            </div>
                            <i class="fas fa-users text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">Total Evaluations</div>
                                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $evaluations }}</div>
                            </div>
                            <i class="fas fa-chart-bar text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modules List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Modules</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($modules as $module)
                        <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 transition">
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $module->nom }}</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Code: {{ $module->code }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Evaluations: {{ $module->evaluations_count }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Coefficient: {{ $module->coefficient }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Latest Evaluations -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Latest Evaluations</h3>
                    <div class="space-y-4">
                        @foreach($latestEvaluations as $evaluation)
                        <div class="border dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 transition">
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $evaluation->titre }}</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Module: {{ $evaluation->module->nom }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Date: {{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Coefficient: {{ $evaluation->coefficient }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>