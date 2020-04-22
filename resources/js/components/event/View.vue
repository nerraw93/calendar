<template>
    <div class="column is-two-thirds has-text-left">
        <h1 class="title is-1">April 2020</h1>

        <div class="box">
            <a v-for="(item, index) in dates" :key="index" :class="{'panel-block': true, 'has-background-primary': checkDate(item.date, item.day)}">
                <span class="panel-icon">
                    {{ item.id + ' ' + item.day }}
                </span>
                <span class="text-center">{{ showName }}</span>
            </a>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash'

    export default {
        props: {
            events: {
                type: Object,
                default: false
            }
        },
        watch: {
            showName: function(value) {
                return value
            }
        },
        data: function() {
            return {
                dates: [],
                name: ''
            }
        },
        methods: {
            checkDate(date, day)
            {
                const currentDate = Date.parse(date)
                const from = Date.parse(this.events.from)
                const to = Date.parse(this.events.to)

                const checkDay = _.find(this.events.days, (value) => { return day === value })

                if (currentDate >= from && currentDate <= to && checkDay) {
                    this.showName = this.events.name

                    return true
                }
                else {
                    this.showName = ''

                    return false
                }
            },
            getDates()
            {
                this.$http.get('events/dates')
                    .then((response) => {
                        this.dates = response.data
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            }
        },
        mounted() {
            this.getDates()
        }
    }
</script>

<style scoped>
    .panel-icon {
        height: auto;
    }

    .text-center {
        margin: 0 auto;
    }
</style>