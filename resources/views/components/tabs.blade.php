@props(['active' => false])
<a wire:navigate
   {{ $attributes->merge([
       'class' => ($active
           ? 'text-fg-brand border-b border-b-brand'
           : 'border-b border-b-transparent hover:text-fg-brand hover:border-b-brand')
           . ' items-center inline-block p-4'
   ]) }}>
   {{ $slot }}
</a>
