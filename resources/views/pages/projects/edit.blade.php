@extends('layouts.app')

@section('content')
    <main class="container py-3">

        <h1>Modifica: {{$project->title}}</h1>

        <form action="{{ route('dashboardprojects.update', $project->slug ) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @method('PUT')
        
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control
                        @error('title')
                            is-invalid
                        @enderror"
                    name="title"
                    id="title"
                    value="{{ old('title', $project->title)}}"
                />
                @error('title')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        
            <div class="mb-3">
                {{-- mostro la precedente immagine del post se esiste --}}
                @if( $project->thumb )
                <img src="{{ asset('/storage/' . $project->thumb) }}" alt="{{ $project->title }}" class="col-6">
                @endif

                <div class="mt-3">
                    <label for="thumb">Carica una nuova immagine</label>
                    <input
                    type="file"
                    name="thumb"
                    id="thumb"
                    class="form-control
                        @error('thumb') is-invalid @enderror">
                </div>
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select-lg 

                @error('type_id') is_invalid @enderror" 
                
                name="type_id" id="type_id">
                    <option selected value="">Seleziona</option>
                    
                    @foreach ($types as $item)
                        <option value="{{$item->id}}"
                            {{$item->id == old('type_id', $project->type ? $project->type->id : '') ? 'selected' : ''}}>
                            {{$item->name}} 
                        </option>
                    @endforeach

                </select>
            </div>
        
            <div class="mb-3">
                <label for="technologies" class="form-label">Select Technologies</label>
                <select multiple 
                class="form-select form-select-lg" 
                name="technologies[]" 
                id="technologies">
                
                    <option value="">Seleziona</option>
                    
                    @forelse ($technologies as $item)

                        @if ( $errors->any() )
                            <option
                                value="{{ $item->id }}"
                                {{ in_array($item->id, old( 'technologies', [] )) ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>

                            @else

                            <option
                                value="{{ $item->id }}"
                                {{ $project->technologies->contains( $item->id ) ? 'selected' : '' }}
                                >
                                {{$item->name}}
                            </option>
                        @endif
                        
                    @empty
                        <option value="">Tecnologe non specificate</option>
                    @endforelse

                </select>
            </div>

            <div class="mb-3">
                <label for="descriptions" class="form-label">Description</label>
                <textarea 
                    class="form-control 
                        @error('descriptions') 
                            is-invalid 
                        @enderror" 
                    name="descriptions" 
                    id="descriptions" 
                    rows="3">{{ old('title', $project->descriptions)}}
                </textarea>
                @error('descriptions')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        
            <div class="mb-3">
                <label for="languages" class="form-label">Languages</label>
                <input 
                    type="text"
                    class="form-control"
                    name="languages" 
                    id="languages"
                    value="{{ old('title', $project->languages)}}"
                    >
            </input>
                @error('languages')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input
                    type="text"
                    class="form-control
                        @error('slug')
                            is-invalid
                        @enderror"
                    name="slug"
                    id="slug"
                    value="{{ old('title', $project->slug)}}"
                />
                @error('slug')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        

    </main>
@endsection