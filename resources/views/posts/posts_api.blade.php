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
        <div class="row posts-wrapper">

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>

        //getPosts();
        function getPosts() {
            axios.get('http://127.0.0.1:8000/api/v1/posts')
            // axios.get('https://jsonplaceholder.typicode.com/posts')
            // axios.get('https://api.openweathermap.org/data/2.5/weather?q=gaza&appid=dccab945679f3bb9019537a309e05e47')
            .then(function(res) {
                console.log(res);
                // $.each(res.data, function(key, post) {
                //     var col = `<div class="col-md-12">
                //         <div class="card">
                //             <div class="card-body">
                //                 <h3>${ post.title }</h3>
                //                 <p>${ post.body }</p>
                //             </div>
                //         </div>
                //     </div>`;

                //     $('.posts-wrapper').append(col);
                // });
            })
            .catch(function(e) {
                console.log(e);
            })
            // axios.post('');
            // axios.put('');
            // axios.delete('');
        }


        //addPost();
        function addPost() {

            // const config = {
            //     Authorization: `Bearer 6|PBcOrtIm3fzs7y78fwjzOx3cwC0mp1wzT3AHDE5i`
            // };

            // axios.get('http://127.0.0.1:8000/api/v1/sanctum',{}, config)
            // .then(res => console.log(res))

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/api/v1/sanctum',
                dataType: "json",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer 6|PBcOrtIm3fzs7y78fwjzOx3cwC0mp1wzT3AHDE5i');
                },
                success: function(res) {
                    console.log(res);
                }
            })

            // axios.post('http://127.0.0.1:8000/api/v1/posts',{

            //     title: 'This is another post from axios',
            //     content: 'This is another content from axios'

            // }
            // ,{
            //     'Authorization': 'Bearer ' + ffffffff
            // }
            // )
            // .then(res => console.log(res))
            // .then(function(res) {
            //     console.log(res);
            // })
        }


        // deletePost();
        function deletePost() {
            axios.delete('http://127.0.0.1:8000/api/v1/posts/11').then(res => console.log(res))
        }

        updatePost();
        function updatePost() {
            axios.put('http://127.0.0.1:8000/api/v1/posts/10', {
                title: 'New New New title axios'
            }).then(res => console.log(res))
        }

    </script>

</body>
</html>
