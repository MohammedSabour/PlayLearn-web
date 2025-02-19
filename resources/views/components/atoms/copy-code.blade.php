<div x-data="{ code: '{{ $session->code_adhesion }}' }">
    <button
        @click="navigator.clipboard.writeText(code).then(() => alert('Code copié : ' + code))"
        class="p-2 hover:bg-quiz-light rounded-lg transition-colors"
        title="Copier le code">
        Copier le code
    </button>
</div>
