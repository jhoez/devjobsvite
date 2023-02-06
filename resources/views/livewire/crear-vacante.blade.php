<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante'>
    <!-- titulo -->
    <div>
        <x-label for="titulo" :value="__('Titulo Vacante')" />

        <x-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" placeholder="Titulo" :value="old('titulo')" autofocus />

        @error('titulo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <!-- salario -->
    <div class="mt-4">
        <x-label for="salario" :value="__('Salario Mensual')" />

        <select wire:model="salario" id="salario" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">-- Seleccione --</option>
            @foreach ($salarios as $item)
                <option value="{{$item->id}}">{{ $item->salario }}</option>
            @endforeach
        </select>

        @error('salario')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <!-- categoria -->
    <div class="mt-4">
        <x-label for="categoria" :value="__('Categoria')" />

        <select wire:model="categoria" id="categoria" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">-- Seleccione --</option>
            @foreach ($categorias as $item)
                <option value="{{$item->id}}">{{ $item->categoria }}</option>
            @endforeach
        </select>

        @error('categoria')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <!-- empresa -->
    <div>
        <x-label for="empresa" :value="__('Empresa')" />

        <x-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" placeholder="Empresa: ej. Netflix, Uber, Shop" />

        @error('empresa')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <!-- ultimo_dia -->
    <div>
        <x-label for="ultimo_dia" :value="__('último dia para postularse')" />

        <x-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')" />

        @error('ultimo_dia')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <!-- descripcion -->
    <div>
        <x-label for="descripcion" :value="__('Descripcion de puesto')" />
        <textarea wire:model="descripcion" id="descripcion" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-72 resize-none" placeholder="Escriba la descripción del puesto"></textarea>

        @error('descripcion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <!-- imagen -->
    <div>
        <x-label for="imagen" :value="__('último dia para postularse')" />

        <x-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" accept="image/*" />

        <div class="my-5 w-80">
            @if ($imagen)
                Imagen:
                <img src="{{ $imagen->temporaryUrl() }}"><!-- temporaryUrl() permite ver la imagen temporal a subir -->
            @endif
        </div>

        @error('imagen')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <x-button>
        Crear Vacante
    </x-button>
</form>
