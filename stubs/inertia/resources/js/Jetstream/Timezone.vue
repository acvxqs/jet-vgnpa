<template>
    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <option disabled class="display:none"></option>
        <option v-for="timezone in timeZonesList" :key="timezone" :value="timezone" :selected="timezone == modelValue">
            {{ timezone }}
        </option>
    </select>
    <div class="mt-2 text-sm font-medium text-gray-900">
        Guessed time zone: <span class="text-sm text-gray-500">{{ defaultTimeZone }}</span>
    </div>
</template>

<script>
    import moment from 'moment';
    require('moment-timezone');
    export default {  
        computed: {
            defaultTimeZone() {
                return moment.tz.guess(true);
            },
            timeZonesList() {
                return moment.tz.names();
            },
        },

        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>