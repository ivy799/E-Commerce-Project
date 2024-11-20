@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 light:border-gray-700 light:bg-gray-900 light:text-gray-300 focus:border-indigo-500 light:focus:border-indigo-600 focus:ring-indigo-500 light:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
