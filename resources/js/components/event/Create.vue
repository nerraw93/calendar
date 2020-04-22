<template>
    <div class="column is-one-third has-text-left">
        <div class="field">
            <label class="label">Event</label>
            <div class="control">
                <input class="input is-medium" type="text" v-model="forms.name">
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <label class="label">From</label>
                <datepicker class="input" v-model="forms.from"></datepicker>
            </div>
            <div class="control">
                <label class="label">To</label>
                <datepicker class="input" v-model="forms.to"></datepicker>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <label class="checkbox" v-for="(item, index) in days" :key="index">
                    <input type="checkbox" v-model="forms.days" :value="item">
                    {{ item }}
                </label>
            </div>
        </div>
        <div class="control">
            <button type="submit" class="button is-link is-fullwidth has-text-weight-medium is-medium" @click="submit()">Save</button>
        </div>

        <notifications group="foo" position="top center" />
    </div>
</template>

<script>
    import Datepicker from 'vue-bulma-datepicker'

    export default {
        components: {
            Datepicker
        },
        data: function() {
            return {
                days: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                forms: {
                    name: '',
                    from: '',
                    to: '',
                    days: []
                }
            }
        },
        methods: {
            submit()
            {
                this.$http.post('events/add', this.forms)
                    .then((response) => {
                        this.$notify({
                            group: 'foo',
                            text: 'Event successfully saved'
                        })
                        this.$emit('fetch')
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            }
        }
    }
</script>

<style scoped>
    .checkbox {
        margin-right: 14px;
    }
</style>