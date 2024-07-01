@extends('layouts.layout')
@section('page-content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Créer un nouveau cours</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{route('instructor.course.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Titre du cours</label>
                            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Prix (FCFA)</label>
                            <input type="number" name="price" id="price" class="form-control" inputmode="numeric" required value="{{ old('price') }}">
                        </div>
                        
                    
                </div>
            </div>

            <!-- Section pour ajouter des modules et des leçons -->
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Ajouter des modules et des leçons</h4>
                </div>
                <div class="card-body">
                    
                        <!-- Ajout de modules -->
                        <div id="modules">
                            <div class="module mb-3">
                                <h5>Module 1</h5>
                                <div class="form-group mb-3">
                                    <label for="module_title_1">Titre du module</label>
                                    <input type="text" name="module_title[]" id="module_title_1" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="module_description_1">Description du module</label>
                                    <textarea name="module_description[]" id="module_description_1" class="form-control"></textarea>
                                </div>
                                
                                <!-- Ajout de leçons pour le module 1 -->
                                <div class="lessons">
                                    <div class="lesson mb-3">
                                        <h6>Leçon 1</h6>
                                        <div class="form-group mb-3">
                                            <label for="lesson_title_1_1">Titre de la leçon</label>
                                            <input type="text" name="lesson_title[1][]" id="lesson_title_1_1" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="lesson_content_1_1">Contenu de la leçon</label>
                                            <textarea name="lesson_content[1][]" id="lesson_content_1_1" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="lesson_pdf_1_1">Téléverser un PDF</label>
                                            <input type="file" name="lesson_pdf[1][]" id="lesson_pdf_1_1" class="form-control-file">
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary btn-sm add-lesson" data-module="1">Ajouter une leçon</button>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-secondary btn-sm add-module">Ajouter un module</button>
                        <button type="submit" class="btn btn-primary">Créer le cours</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Mes Cours</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->description }}</td>
                            <td>
                                <a href="{{--{{ route('instructor.courses.edit', $course->id) }}--}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('instructor.courses.delete', $course->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<script>
    let moduleCount = 1;
    document.querySelector('.add-module').addEventListener('click', function() {
        moduleCount++;
        const moduleHtml = `
        <div class="module mb-3">
            <h5>Module ${moduleCount}</h5>
            <div class="form-group mb-3">
                <label for="module_title_${moduleCount}">Titre du module</label>
                <input type="text" name="module_title[]" id="module_title_${moduleCount}" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="module_description_${moduleCount}">Description du module</label>
                <textarea name="module_description[]" id="module_description_${moduleCount}" class="form-control"></textarea>
            </div>
            
            <div class="lessons">
                <div class="lesson mb-3">
                    <h6>Leçon 1</h6>
                    <div class="form-group mb-3">
                        <label for="lesson_title_${moduleCount}_1">Titre de la leçon</label>
                        <input type="text" name="lesson_title[${moduleCount}][]" id="lesson_title_${moduleCount}_1" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lesson_content_${moduleCount}_1">Contenu de la leçon</label>
                        <textarea name="lesson_content[${moduleCount}][]" id="lesson_content_${moduleCount}_1" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lesson_pdf_${moduleCount}_1">Téléverser un PDF</label>
                        <input type="file" name="lesson_pdf[${moduleCount}][]" id="lesson_pdf_${moduleCount}_1" class="form-control-file">
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary btn-sm add-lesson" data-module="${moduleCount}">Ajouter une leçon</button>
        </div>`;
        document.getElementById('modules').insertAdjacentHTML('beforeend', moduleHtml);
        addLessonEventListeners();
    });

    function addLessonEventListeners() {
        document.querySelectorAll('.add-lesson').forEach(button => {
            button.addEventListener('click', function() {
                const moduleNumber = this.getAttribute('data-module');
                const lessonCount = document.querySelectorAll(`#modules .module:nth-child(${moduleNumber}) .lesson`).length + 1;
                const lessonHtml = `
                <div class="lesson mb-3">
                    <h6>Leçon ${lessonCount}</h6>
                    <div class="form-group mb-3">
                        <label for="lesson_title_${moduleNumber}_${lessonCount}">Titre de la leçon</label>
                        <input type="text" name="lesson_title[${moduleNumber}][]" id="lesson_title_${moduleNumber}_${lessonCount}" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lesson_content_${moduleNumber}_${lessonCount}">Contenu de la leçon</label>
                        <textarea name="lesson_content[${moduleNumber}][]" id="lesson_content_${moduleNumber}_${lessonCount}" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lesson_pdf_${moduleNumber}_${lessonCount}">Téléverser un PDF</label>
                        <input type="file" name="lesson_pdf[${moduleNumber}][]" id="lesson_pdf_${moduleNumber}_${lessonCount}" class="form-control-file">
                    </div>
                </div>`;
                this.previousElementSibling.insertAdjacentHTML('beforeend', lessonHtml);
            });
        });
    }

    addLessonEventListeners();
</script>
@endsection
