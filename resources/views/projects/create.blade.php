<!Doctype html>

<html>
<head>
    <title></title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
</head>
<body>
<div>
    <form method="POST" action="/projects" class="container" style="padding-top: 40px ">

        @csrf

        <h1 class="heading is-1">Create a project</h1>

        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="controls">
                <input type="text" class="input" name="title" placeholder="Title">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>

            <div class="controls">
                <textarea name="description"  for="description" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">

            <div class="controls">
                <button type="submit" class="button is-link" >Submit</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
