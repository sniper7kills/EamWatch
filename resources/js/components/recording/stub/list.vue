<template>
    <div>
        <div class="text-muted" v-for="recording in recordings">
            <p class="text-sm">
                <a href="#">{{recording.id}}</a>
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
    export default {
        name: "RecordingListStub",
        props: ['recordings']
    }
</script>

<style scoped>

</style>
