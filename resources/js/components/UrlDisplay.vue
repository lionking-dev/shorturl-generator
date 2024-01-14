<!-- resources/js/components/UrlDisplay.vue -->
<template>
    <div v-if="shortenedUrl">
        <p>Shortened URL:</p>
        <a :href="shortenedUrl" target="_blank">{{ shortenedUrl }}</a>
    </div>
</template>

<script>
export default {
    props: {
        shortenedUrl: String,
    },
};
</script>
