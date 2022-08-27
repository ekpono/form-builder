<template>
  <Head title="Dashboard" />

  <template>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Dashboard
    </h2>
  </template>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <ValidationErrors class="mb-4" />

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <form
              type="GET"
              :action="route('auth.shopify')"
          >
            <!-- Name -->
            <div>
              <Label
                  for="shop"
                  value="Shopify URL"
              />

              <Input
                  id="shop"
                  v-model="form.shop"
                  class="block mt-1 w-full"
                  type="text"
                  name="shop"
                  required
                  autofocus
              />
            </div>

            <div class="flex items-center justify-end mt-4">
              <Button
                  class="ml-4"
                  :disabled="form.processing"
              >
                Connect
              </Button>
            </div>
          </form>
        </div>
      </div>

      <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <form
              method="GET"
              :action="route('auth.woocommerce')"
          >
            <!-- Name -->
            <div>
              <Label
                  for="store_url"
                  value="WooCommerce URL"
              />

              <Input
                  id="store_url"
                  v-model="form.store_url"
                  class="block mt-1 w-full"
                  type="text"
                  name="store_url"
                  required
                  autofocus
              />
            </div>

            <div class="flex items-center justify-end mt-4">
              <Button class="ml-4">
                Connect
              </Button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import ValidationErrors from '../../Components/ValidationErrors'
import Label from '../../Components/Label'
import Input from '../../Components/Input'
import Button from '../../Components/Button'

export default {
  components: {
    Button,
    Input,
    Label,
    ValidationErrors,
    Head
  },
  data () {
    return {
      form: {
        shop: null,
        store_url: null
      }
    }
  }
}
</script>
