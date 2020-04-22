<template>
    <div class="columns is-8 is-variable">
        <create-event
            @fetch="getEvents"
        >
        </create-event>

        <view-event
            :events="list"
        ></view-event>
    </div>
</template>

<script>
    import CreateEvent from '../components/event/Create.vue'
    import ViewEvent from '../components/event/View.vue'

    export default {
        components: {
            CreateEvent,
            ViewEvent
        },
        data: function() {
            return {
                list: {}
            }
        },
        methods: {
            getEvents()
            {
                this.$http.get('events/fetch')
                    .then((response) => {
                        this.list = response.data
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            },
            
        },
        mounted() {
            this.getEvents()
        }
    }
</script>