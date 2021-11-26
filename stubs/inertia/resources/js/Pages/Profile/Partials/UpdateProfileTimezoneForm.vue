<template>
    <jet-form-section @submitted="updateProfileTimezone">
        <template #title>
            Timezone Information
        </template>

        <template #description>
            Update your account's timezone information.
        </template>

        <template #form>
            <!-- Timezone -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="timezone" value="Timezone" />
                <div id="timezone" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <select v-model="timezone">
                        <option disabled class="display:none"></option>
                        <option v-for="timezone in timeZonesList" :key="timezone" :value="timezone" :selected="timezone">
                            {{ timezone }}
                        </option>
                    </select>
                </div>
                <div class="mt-2 text-sm font-medium text-gray-900">
                    Guessed time zone: <span class="text-sm text-gray-500">{{ defaultTimeZone }}</span>
                </div>
                <jet-input-error :message="form.errors.timezone" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import moment from 'moment';
    require('moment-timezone');
    
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        computed: {
            defaultTimeZone() {
                return moment.tz.guess(true);
            },
            timeZonesList() {
                return moment.tz.names();
            },
        },

        props: ['user']

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    timezone: this.user.timezone,
                }),
            }
        },

        methods: {
            updateProfileTimezone() {
                this.form.post(route('user-profile-timezone.update'), {
                    errorBag: 'updateTimezoneInformation',
                    preserveScroll: true,
                });
            },
            focus() {
                this.$refs.input.focus()
            },
        },
    }).mount('#timezone')
</script>