<template>
    <div>
         <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {

        props: ['userId', 'follows',],

        mounted() {
            console.log('Component mounted.')
        },

        data : function() {
            return {
                status: this.follows,
            }
        },

        methods: {
            followUser() {
                axios.post('/follow/' + this.userId).then(response => {
                    this.status = !this.status;
                    location.reload();
                    
                })
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'UnFollow' : 'Follow';
            }
        }
    }
</script>
