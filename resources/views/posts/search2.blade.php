<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts CRUD AJAX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .form-wrapper {
            position: relative;
        }

        .result-wrapper {
            position: absolute;
            top: 100%;
            width: 100%;
        }

        .result-wrapper a {
            display: block;
            padding: 15px;
            background: #f2f2f2;
            text-decoration: none;
            border-bottom: 1px solid #c2c2c2;
            color: #333;
        }

        .result-wrapper a:hover {
            background: #d6d6d6;
        }

    </style>
</head>
<body>

    <div class="container my-5">
        <h2>Our Posts</h2>
        <div class="row mt-4">
            <div class="col-12">
                <div class="form-wrapper">
                    <input id="keyword" class="form-control" placeholder="Search Here..">
                    <div class="result-wrapper">
                    </div>
                </div>
            </div>
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
                    url: '{{ route("search_post2") }}',
                    data: {
                        k: keyword
                    },
                    success: function(res) {
                        $('.result-wrapper').html('');
                        $.each(res, function(key, post) {
                            let col = `<a href="${post.url}">${post.title}</a>`;

                            $('.result-wrapper').append(col);
                        })
                    }
                })
            }else {
                $('.result-wrapper').html('');
            }
        })

    </script>
</body>
</html>
