<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="title">
                <h3>Video</h3>
                    <VideoPlayer :video-url="videoUrl" />
            </div>
        </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import VideoPlayer from './VideoPlayerComponent.vue';

const videoUrl = ref('/videos/');


const changeVideo = (newVideoUrl) => { // Function to test changing video
    videoUrl.value = newVideoUrl;
};

</script>

<style scoped>
.title {
    padding: 12px 0;
}
</style>
