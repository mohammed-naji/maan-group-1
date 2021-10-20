<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts CRUD AJAX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="container my-5">
        <h2>Our Posts</h2>
        <div class="row mt-4">
            <div class="col-4">
                <form action="{{ route('posts.store') }}" method="post" id="form_data">
                    @csrf
                    <input type="text" id="title" name="title" placeholder="Title" class="form-control mb-3">
                    <textarea name="content" id="content" placeholder="Content" rows="5" class="form-control mb-3"></textarea>
                    <button class="btn btn-dark">Add</button>
                </form>
            </div>
            <div class="col-8">
                <table class="table table-bordered" id="table_data">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        getData();
        function getData() {
            $('#table_data tbody').html('');
            $.ajax({
                type: 'get',
                url: '{{ route("posts.getData") }}',
                success: function(res) {
                    $.each(res, function(key, post) {
                        let row = `
                            <tr>
                                <td>${post.id}</td>
                                <td>${post.title}</td>
                                <td>${post.content}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#table_data tbody').append(row)
                    })
                }
            })
        }

        $('#form_data').submit(function(e) {
            e.preventDefault();

            // var data = new FormData($('#form_data')[0]);
            var title = $('#title').val();
            var content = $('#content').val();

            $.ajax({
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    title: title,
                    content: content
                },
                url: '{{ route("posts.store") }}',
                success: function(res) {
                    // alert('Done');
                    // getData();
                    let row = `
                            <tr>
                                <td>${res.post.id}</td>
                                <td>${res.post.title}</td>
                                <td>${res.post.content}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#table_data tbody').prepend(row)
                    $('#form_data').trigger('reset');
                },
                error: function() {

                }
            })
        })

    </script>

</body>
</html>
