@props(['index' => '', 'multiplier' => '', 'length' => '', 'width' => '', 'height' => ''])

<div class="multiplier">
    <x-forms.inputs.text :name=" 'model-sizes['.$index.'][multiplier]' "
                         :type=" 'number' "
                         :placeholder=" 'Множитель размера' "
                         :value=" $multiplier "
                         autocomplete="off"
                         required
    />
</div>
<div class="actual-values">
    <x-forms.inputs.text :name=" 'model-sizes['.$index.'][length]' "
                         :type=" 'number' "
                         :placeholder=" 'Длина' "
                         :value=" $length "
                         autocomplete="off"
                         required
    />
    <x-forms.inputs.text :name=" 'model-sizes['.$index.'][width]' "
                         :type=" 'number' "
                         :placeholder=" 'Ширина' "
                         :value=" $width "
                         autocomplete="off"
                         required
    />
    <x-forms.inputs.text :name=" 'model-sizes['.$index.'][height]' "
                         :type=" 'number' "
                         :placeholder=" 'Высота' "
                         :value=" $height "
                         autocomplete="off"
                         required
    />
</div>
<button class="delete">X</button>
