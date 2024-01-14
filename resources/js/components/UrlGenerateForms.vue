<!-- resources/js/components/UrlForms.vue -->
<template>
    <div class="container mt-5">
        <h2 class="mb-4">URL Shortener</h2>
        <form @submit.prevent="submitUrl">
            <div class="row">
                <div class="col-md-6">
                    <label for="originalUrl" class="form-label">Original URL:</label>
                    <input type="url" id="originalUrl" v-model="originalUrl" class="form-control" required />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mt-3 ">Submit</button>
                </div>
            </div>
            
        </form>
        <div v-if="shortenedUrl" class="mt-4">
            <p class="mb-2">Shortened URL:</p>
            <a :href="'api/' + id" target="_blank" class="btn btn-success">{{ shortenedUrl }}</a>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        shortenedUrl: {
            type: String,
            required: true,
        },
        id:{
            type: Number,
            required: true
        }
    },
    data() {
        return {
            originalUrl: "",
            // shortenedUrl: null,
        };
    },
    methods: {
        async submitUrl() {
            try{
                const response = await axios.post("/api/check-url", {
                    originalUrl: this.originalUrl,
                });
                this.$emit("submit-url", this.originalUrl);
                // Handle the response from the backend
                if (response.data.isSafe) {
                    // URL is safe, continue with URL shortening logic
                    this.$emit("submit-url", this.originalUrl);
                } else {
                    // URL is not safe, handle accordingly (e.g., show a warning)
                    alert("The provided URL is not safe.");
                }
            } catch(error){
                console.error('Error: ', error.message);
            }
            // this.shortenedUrl = "example.com/abc123";
        },
    },
};
</script>