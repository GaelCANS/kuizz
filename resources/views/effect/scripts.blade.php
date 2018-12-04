@forelse($quizz->template->scriptEffect as $script)
    <script src="{{ url('/js/'.$script) }}"></script>
    @empty
@endforelse