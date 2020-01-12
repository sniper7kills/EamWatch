<template>
    <div>
        <div class="text-muted" v-for="recording in recordings">
            <p class="text-sm">
                <router-link tag="a" :to="{ name: 'recording-view', params: { recording_id: recording.id } }">
                    {{recording.id}}
                </router-link>
            </p>
            <vue-plyr>
                <audio>
                    <source v-bind:src="recording.link" type="audio/mp3"/>
                </audio>
            </vue-plyr>
        </div>
    </div>
</template>

<script>
    import VuePlyr from 'vue-plyr';
    export default {
        name: "RecordingListStub",
        props: ['recordings'],
        components: {
            VuePlyr
        }
    }
</script>

<style scoped>

</style>
