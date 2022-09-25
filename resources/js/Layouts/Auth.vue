<template>
  <div>
    <x-auth-navbar />
    <main>
      <section class="relative w-full h-full py-40 min-h-screen">
        <div class="absolute top-0 w-full h-full bg-blueGray-800 bg-no-repeat bg-full"></div>
        <slot />
        <x-footer-small absolute />
      </section>
    </main>
  </div>
</template>
