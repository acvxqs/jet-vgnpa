<template>
  <div class="py-4">
    <Switch
      v-model="proxyChecked"
      class="relative inline-flex flex-shrink-0 h-[38px] w-[74px] border-2 rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none"
    >
      <span
        aria-hidden="true"
        :class="proxyChecked ? 'bg-gray-900 translate-x-9' : 'bg-grey-200 translate-x-0'"
        class="pointer-events-none inline-block h-[34px] w-[34px] rounded-full shadow-lg transform ring-0 transition ease-in-out duration-200"
      />
    </Switch>
  </div>
</template>

<script>
import { ref } from 'vue'
import { Switch } from '@headlessui/vue'
import { defineComponent } from 'vue'

export default defineComponent({
    components: { Switch },

    emits: ['update:checked'],

    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
    },
})
</script>
