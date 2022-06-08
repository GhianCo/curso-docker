const colors = require('tailwindcss/colors');

module.exports = {
	purge: {
		enabled: process.env.PURGE_TW === 'true',
		content: ['./src/**/*.html', './src/**/*.ts'],
	},
  darkMode: 'class', // or 'media' or 'class'
	theme: {
		extend: {
			colors: {
				primary: {
					DEFAULT: 'var(--ion-color-primary)',
					shade: 'var(--ion-color-primary-shade)',
					tint: 'var(--ion-color-primary-tint)',
				},
				secondary: {
					DEFAULT: 'var(--ion-color-secondary)',
					shade: 'var(--ion-color-secondary-shade)',
					tint: 'var(--ion-color-secondary-tint)',
				},
				tertiary: {
					DEFAULT: 'var(--ion-color-tertiary)',
					shade: 'var(--ion-color-tertiary-shade)',
					tint: 'var(--ion-color-tertiary-tint)',
				},
				light: {
					DEFAULT: 'var(--ion-color-light)',
					shade: 'var(--ion-color-light-shade)',
					tint: 'var(--ion-color-light-tint)',
				},
				medium: {
					DEFAULT: 'var(--ion-color-medium)',
					shade: 'var(--ion-color-medium-shade)',
					tint: 'var(--ion-color-medium-tint)',
				},
				dark: {
					DEFAULT: 'var(--ion-color-dark)',
					shade: 'var(--ion-color-dark-shade)',
					tint: 'var(--ion-color-dark-tint)',
				},
				success: {
					DEFAULT: 'var(--ion-color-success)',
					shade: 'var(--ion-color-success-shade)',
					tint: 'var(--ion-color-success-tint)',
				},
				warning: {
					DEFAULT: 'var(--ion-color-warning)',
					shade: 'var(--ion-color-warning-shade)',
					tint: 'var(--ion-color-warning-tint)',
				},
				danger: {
					DEFAULT: 'var(--ion-color-danger)',
					shade: 'var(--ion-color-danger-shade)',
					tint: 'var(--ion-color-danger-tint)',
				},
				step: {
					'50': 'var(--ion-color-step-50)',
					'100': 'var(--ion-color-step-100)',
					'150': 'var(--ion-color-step-150)',
					'200': 'var(--ion-color-step-200)',
					'250': 'var(--ion-color-step-250)',
					'300': 'var(--ion-color-step-300)',
					'350': 'var(--ion-color-step-350)',
					'400': 'var(--ion-color-step-400)',
					'450': 'var(--ion-color-step-450)',
					'500': 'var(--ion-color-step-500)',
					'550': 'var(--ion-color-step-550)',
					'600': 'var(--ion-color-step-600)',
					'650': 'var(--ion-color-step-650)',
					'700': 'var(--ion-color-step-700)',
					'750': 'var(--ion-color-step-750)',
					'800': 'var(--ion-color-step-800)',
					'850': 'var(--ion-color-step-850)',
					'900': 'var(--ion-color-step-900)',
					'950': 'var(--ion-color-step-950)',
				},
				order: {
					ontime: 'var(--dgo-order-ontime)',
					delayed: 'var(--dgo-order-delayed)',
					critical: 'var(--dgo-order-critical)',
				}
			},
		},
	},
	variants: {
    extend: {},
  },
	corePlugins: {
		textOpacity: false,
		backgroundOpacity: false,
	},
	plugins: [],
};
