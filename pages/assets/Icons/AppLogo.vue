<template>
<div>
  <img src="../new_logo_copy.png" height="100px" width="50px"/>
</div>

</template>
<script setup lang="ts">
defineProps({
size: {
    type: [String, Number],
    default: 30
}
})
</script>
<style scoped>
/* Add this media query */
@media only screen and (min-width: 768px) {
  .logo {
    width: 150px; /* increase the width to 250px in desktop mode */
  }
}
</style>
    