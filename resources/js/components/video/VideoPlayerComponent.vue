<template>
    <div>
        <video ref="videoPlayer" class="video-js vjs-default-skin" controls>
            <source :src="videoUrl" type="video/mp4" />
            Your browser does not support the video tag.
        </video>
    </div>
</template>

<script setup>

import { ref, watchEffect } from 'vue';
import videojs from 'video.js';
import 'video.js/dist/video-js.css';

const videoUrl = ref('');

watchEffect(() => {
  if (videoUrl.value) {
    const player = videojs(refs.videoPlayer);
    player.src(videoUrl.value);
    player.load();
  }
});

</script>