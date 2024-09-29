<template>
    <header>
      <div class="background-image" />
      <img src="/pages/assets/our_community.png" alt="Bottom image" class="bottom-image">
      <div class="mask"></div>
      <div class="banner-container">
        <UCarousel  ref="carouselRef" v-slot="{ item }" :items="items" :ui="{ item: 'basis-full' }" class="overflow-hidden" arrows>
          <img :src="item" class="w-full photo-banner" draggable="false">
      </UCarousel>
      </div>
    </header>
  </template>

<script setup lang="ts">
  const items = [
    'https://picsum.photos/1920/1080?random=1',
    'https://picsum.photos/1920/1080?random=2',
    'https://picsum.photos/1920/1080?random=3',
    'https://picsum.photos/1920/1080?random=4',
    'https://picsum.photos/1920/1080?random=5',
    'https://picsum.photos/1920/1080?random=6'
  ]

  const carouselRef = ref()

  onMounted(() => {
  setInterval(() => {
    if (!carouselRef.value) return

    if (carouselRef.value.page === carouselRef.value.pages) {
      return carouselRef.value.select(0)
    }

    carouselRef.value.next()
  }, 3000)
})

</script>
  
  <style scoped>
    .background-container {
      position: absolute;
      bottom: 0;
      right: 0;
      display: flex;
      align-items: flex-end;
    }
  
    .banner-container {
      background-size: cover;
      background-position: center;
      height: 90vh;
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      border-radius: 0 0 50px 50px;
    }
  
    /* .upper-image {
      width: 50%;
      position: absolute;
      opacity: 0.6;
      left: 20%; 
      transform: matrix(0.98, 0.18, -0.31, 0.95, 0, 0);
      margin-top: -15%;
    }
  
    @media only screen and (max-width: 1084px) {
      .upper-image {
        top: 0;
      }
    } */
  
    .bottom-image {
      position: absolute;
      margin-top: 20px;
      bottom: -100px;
      left: 50%;
      transform: translateX(-50%);
      width: 200px;
      height: 200px;
      border-radius: 50%;
    }
  
    .photo-banner{
      bottom: 0px; /* add some margin to the bottom */
      right: 0px; /* add some margin to the right */
      height: 100vh;
      object-fit: cover;
      z-index: -1;
       background-size: cover;
      background-position: center;
      width: 100%;
      top: 0;
      left: 0;
    }
  
    .banner-image {
      position: absolute;
      height: 100px;
      width: 100px;
      bottom: 50%; /* add some margin to the bottom */
      right: 100px;
      margin-left: 20px;
    }
  
    @media only screen and (max-width: 710px) {
      .banner-image {
        display: none;
      }
    }
  </style>