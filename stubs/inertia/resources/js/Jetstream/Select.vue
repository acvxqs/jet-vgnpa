<template>
    <select  
        v-model="proxySelected"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        @input="$emit('update:modelValue', $event.target.value)" ref="input"
        >
        <option disabled>Please select an option</option>
        <option v-for="option in options" :key="option" :value="option">
            {{ option }}
        </option>
    </select>
</template>
<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['options', 'option_default', 'modelValue'], 

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        },

        computed: {
            proxySelected: {
                get() {
                    return this.modelValue;
                },

                set(val) {
                    this.$emit("update:modelValue", val);
                },
            },
        },
    })
</script>
