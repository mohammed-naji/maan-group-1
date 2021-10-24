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
                    <button class="btn btn-dark btn-add">Add</button>
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

        $('#form_data').on('click', '.btn-add', function(e) {
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
                success: function(response) {
                    // alert('Done');
                    // getData();
                    add_row(response.post)
                    $('#form_data').trigger('reset');
                },
                error: function() {

                }
            })
        })

        getData();

        $('#table_data').on('click', '.btn-delete', function() {
            var id = $(this).data('id'); // data-id
            var btn = $(this);

            if(confirm('Are You Sure ?!')) {
                $.ajax({
                    type: 'delete',
                    url: '{{ route("posts.index") }}/'+id,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        btn.parents('tr').remove();
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }

        });

        $('#table_data').on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            var btn = $(this);

            var title = btn.parents('tr').find('.title').text();
            var content = btn.parents('tr').find('.content').text();

            var url = '{{ route("posts.index") }}/'+id;
            $('#form_data').attr('action', url)

            $('#title').val(title);
            $('#content').val(content);

            $('form button').text('Update');
            $('form button').removeClass('btn-add');
            $('form button').addClass('btn-update');
        })

        $('#form_data').on('click', '.btn-update', function(e) {
            e.preventDefault();

            var title = $('#title').val();
            var content = $('#content').val();
            var url = $('#form_data').attr('action');

            $.ajax({
                type: 'put',
                url: url,
                data:{
                    _token: '{{ csrf_token() }}',
                    title: title,
                    content: content
                },
                success: function(res) {


                    // Update record data

                    $('#row-' + res.id).find('.title').text(res.title);
                    $('#row-' + res.id).find('.content').text(res.content);


                    $('#form_data').trigger('reset');
                    $('form button').text('Add');
                    $('form button').addClass('btn-add');
                    $('form button').removeClass('btn-update');

                }
            })

        })

        function getData() {
            $('#table_data tbody').html('');
            $.ajax({
                type: 'get',
                url: '{{ route("posts.getData") }}',
                success: function(res) {
                    $.each(res, function(key, post) {
                        add_row(post);
                    })
                }
            })
        }

        function add_row(post) {
            let row = `
                <tr id="row-${post.id}">
                    <td class="id">${post.id}</td>
                    <td class="title">${post.title}</td>
                    <td class="content">${post.content}</td>
                    <td>
                        <button data-id="${post.id}" class="btn btn-primary btn-sm btn-edit">Edit</button>
                        <button data-id="${post.id}" class="btn btn-danger btn-sm btn-delete">Delete</button>
                    </td>
                </tr>
            `;
            $('#table_data tbody').append(row)
        }

    </script>

</body>
</html>
