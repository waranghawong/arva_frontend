<script lang="ts" setup>
import Toaster from '@/components/ui/toast/Toaster.vue'
</script>

<template>
  <Head>
    <Link
      href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
  </Head>
  <Body class="antialiased">
    <NuxtLayout>
      <v-app>
      <NuxtPage />
      </v-app>
    </NuxtLayout>
  </Body>
    <Toaster />
</template>
