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
            <div class="col-12">
                <input id="keyword" class="form-control" placeholder="Search Here..">
            </div>
        </div>

        <div class="row mt-5 post-wrapper">

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        $('#keyword').keyup(function() {
            var keyword = $(this).val();

            if(keyword.length > 3) {
                $.ajax({
                    type: 'get',
                    url: '{{ route("search_post") }}',
                    data: {
                        k: keyword
                    },
                    success: function(res) {
                        $('.post-wrapper').html('');
                        $.each(res, function(key, post) {
                            let col = `
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>${post.title}</h3>
                                        <p>${post.content}</p>
                                    </div>
                                </div>
                            </div>
                            `;

                            $('.post-wrapper').append(col);
                        })
                    }
                })
            }else {
                $('.post-wrapper').html('');
            }
        })

    </script>
</body>
</html>
