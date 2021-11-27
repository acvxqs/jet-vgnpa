<template>
    <select  
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        @change="$emit('update:modelValue', $event.target.value)" ref="change"
        >
        <option v-for="option in options" :key="option" :value="option" :selected="option == option_default">
            {{ option }}
        </option>
    </select>
</template>
<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['options', 'option_default'], 

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        },

        computed: {
            modelValue: {
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
