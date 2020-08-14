<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-danger">
                    <div class="card-header">WARNING:</div>
                    <div class="card-body">
                        The API is still under active development.<br/>
                        It may change anytime without warning!
                    </div>
                </div>
            </div>
        </div>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
