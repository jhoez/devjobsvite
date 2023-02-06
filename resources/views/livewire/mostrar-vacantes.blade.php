<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacantes as $item)
            <div class="p-5 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{route('vacantes.show',$item->id)}}" class="font-bold">{{$item->titulo}}</a>
                    <p class="text-sm text-gray-600 font-bold">{{$item->empresa}}</p>
                    <p>Ultimo dia: {{$item->ultimo_dia->format('d/m/Y')}}</p>
                </div>

                <div class="flex flex-col items-stretch gap-3 mt-5 md:mt-0"><!-- flex-row -->
                    <a href="{{ route('candidatos.index',$item) }}" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs text-center font-bold uppercase">
                        {{$item->candidatos->count()}} Candidatos
                    </a>
                    <a href="{{ route('vacantes.edit', $item->id) }}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs text-center font-bold uppercase">
                        Editar
                    </a>
                    <button wire:click="$emit('mostrarAlerta',{{ $item->id }})" class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs text-center font-bold uppercase">
                        Eliminar
                    </button>
                </div>
            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay vacantes</p>
        @endforelse
    </div>

    <div class="mt-10">
        {{$vacantes->links()}}{{-- paginacion --}}
    </div>
    
    @push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        <script>
            Livewire.on('mostrarAlerta', vacanteID =>{
                Swal.fire({
                    title: '¿Eliminar Vacante?',
                    text: "Una Vacante eliminada no se puede recuperar!!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('eliminarVacante',vacanteID);
                        Swal.fire(
                            'Vacante Eliminada!!',
                            'Eliminada correctamente.',
                            'success'
                        )
                    }
                });
            });
        </script>
    @endpush
</div>


