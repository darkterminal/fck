<h1 class="text-2xl my-3 text-center">Contact <?= $name ?></h1>
<form action="" method="post" class="w-[80%] mx-auto">
    <label class="form-control w-full">
        <div class="label">
            <span class="label-text">Subject</span>
        </div>
        <input type="text" name="subject" placeholder="Type here" class="input input-bordered w-full" />
    </label>
    <label class="form-control w-full">
        <div class="label">
            <span class="label-text">Email</span>
        </div>
        <input type="email" name="email" placeholder="Type here" class="input input-bordered w-full" />
    </label>
    <label class="form-control">
        <div class="label">
            <span class="label-text">Body</span>
        </div>
        <textarea name="body" class="textarea textarea-bordered h-24" placeholder="Type here"></textarea>
    </label>
    <button class="btn btn-outline btn-block my-3" type="submit">Default</button>
</form>
