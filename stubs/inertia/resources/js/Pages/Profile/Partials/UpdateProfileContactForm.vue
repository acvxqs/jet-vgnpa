<template>
    <jet-form-section @submitted="updateProfileContact">
        <template #title>
            Contact Information
        </template>

        <template #description>
            Update your account's contact information.
        </template>

        <template #form>
            <!-- Phone -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="phone" value="Phone number" />
                <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" autocomplete="phone" />
                <jet-input-error :message="form.errors.phone" class="mt-2" />
            </div>
            
            <!-- Allow calls -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="allow_calls" value="Allow calls" />
                <jet-switch id="allow_calls" name="allow_calls" v-model:checked="form.allow_calls" />
            </div>

            <!-- Telegram -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="tg_username" value="Telegram ID" />
                <jet-input disabled id="tg_username" type="text" class="mt-1 block w-full" v-model="form.tg_username" />
                <jet-input-error :message="form.errors.tg_username" class="mt-2" />
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
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import JetSwitch from '@/Jetstream/Switch.vue'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
            JetSwitch,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    phone: this.user.phone,
                    tg_username: this.user.tg_username,
                    allow_calls: this.user.allow_calls,
                }),
            }
        },

        methods: {
            updateProfileContact() {
                this.form.post(route('user-profile-contact.update'), {
                    errorBag: 'updateContactInformation',
                    preserveScroll: true,
                });
            },
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        allow_calls: this.form.allow_calls ? true : false
                    }))
            },
        },
    })
</script>
