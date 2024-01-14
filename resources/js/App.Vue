<!-- resources/js/App.vue -->
<template>
    <div>
        <h2>Vue Component in Laravel</h2>
        <UrlForm @submit-url="submitUrl" :shortenedUrl="shortenedUrl" :id="id"/>
    </div>
</template>
<script>
import axios from "axios";
import UrlForm from "./components/UrlGenerateForms.vue";
export default {
    data() {
        return {
            shortenedUrl: null,
            id: null
        };
    },
    methods: {
        async submitUrl(originalUrl) {
            try{
                const response = await axios.post("/api/submit", {
                    originalUrl: originalUrl,
                });
                if(response.status == 200){
                    this.shortenedUrl = response.data.shortenedUrl;
                    this.id = response.data.id;
                }else{
                    this.shortenedUrl = null;
                }
                // Handle the response from the backend
            } catch(error){
                console.error('Error: ', error.message);
            }

        },
    },
    components: {
        UrlForm,
    },
};
</script>