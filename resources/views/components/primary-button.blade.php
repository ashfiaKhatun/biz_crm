<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex w-100 btn btn-primary tracking-widest']) }}>
    {{ $slot }}
</button>
