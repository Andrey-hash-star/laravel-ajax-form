@extends('layouts.layout')

@section('title', 'Форма добавления новой статьи')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <h1 class="text-center mb-3">Форма добавления новой статьи</h1>
            <div class="alert alert-danger mb-3" style="display: none" id="errorMessage" role="alert"></div>
            <div class="alert alert-success mb-3" style="display: none" id="successMessage" role="alert"></div>
            <div class="col">
                <form id="mainForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Заголовок</label>
                        <input type="text" class="form-control" id="title" placeholder="Введите название статьи">
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Автор</label>
                        <input type="text" class="form-control" id="author" placeholder="Введите автора статьи">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Статья</label>
                        <textarea class="form-control" id="text" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" id="save" value="Сохранить">
                    </div>
                </form>
            </div>
            <div class="text-center">
                <hr>
                <a href="{{ route('articles.index') }}" class="text-center mt-2">Списое статей</a>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $("#save").click(function(e) {

            e.preventDefault();

            let title = $("#title").val().trim();
            let author = $("#author").val().trim();
            let description = $("#description").val().trim();
            let text = $("#text").val().trim();

            /* Валидация также дублируется на сервере */
            if (title == "") {
                $("#errorMessage").show();
                $("#errorMessage").text("Введите заголовок статьи");
                return false;
            } else if (author == "") {
                $("#errorMessage").show();
                $("#errorMessage").text("Введите автора статьи");
                return false;
            } else if (description == "") {
                $("#errorMessage").show();
                $("#errorMessage").text("Введите краткое описание статьи");
                return false;
            } else if (text.length < 30) {
                $("#errorMessage").show();
                $("#errorMessage").text("Статья должна содержать не менее 30 символов");
                return false;
            }

            $("#errorMessage").hide();
            $("#errorMessage").text("");

            $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }

            });

            $.ajax({

                url: '{{ url('/articles') }}',
                method: 'POST',
                cache: false,
                data: {
                    'title': title,
                    'author': author,
                    'description': description,
                    'text': text,
                },
                beforeSend: function() {
                    $("#save").prop("disabled",
                    true); // Делает не доступной кнопку Сохранить пока идет запрос
                },
                success: function(result) {
                    $("#successMessage").show();
                    $("#successMessage").html(result.successMessage);
                    $("#mainForm").trigger('reset'); // Очищает форму
                    $("#save").prop("disabled", false); // Разблокирует кнопку
                }

            });

        });

    });
</script>
