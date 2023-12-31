<?php
/** @var Exception $exception */
?>
<div class="grid h-screen place-content-center px-4">
  <div class="text-center">
    <h1 class="text-9xl font-black"><?= $exception->getCode() ?></h1>

    <p class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
      Uh-oh!
    </p>

    <p class="mt-4 text-gray-500 dark:text-gray-400"><?= $exception->getMessage() ?></p>

    <a
      href="/"
      class="mt-6 inline-block rounded bg-indigo-600 px-5 py-3 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring"
    >
      Go Back Home
    </a>
  </div>
</div>