/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      // Custom Colors
      colors: {
        // Palette Utama
        cream: '#E8DCC4',
        beige: '#E8DCC4',
        dark: '#1a1a1a',
        'dark-text': '#000000',

        // Accent Colors (Rainbow Gradient untuk borders)
        'accent-red': '#E74C3C',
        'accent-orange': '#F39C12',
        'accent-yellow': '#F1C40F',
        'accent-green': '#27AE60',
        'accent-blue': '#3498DB',
        'accent-purple': '#8E44AD',
        'accent-pink': '#E91E63',
        'accent-teal': '#1ABC9C',
        
        // Neutral
        black: '#000000',
        white: '#FFFFFF',
      },

      // Typography
      fontSize: {
        'hero-lg': ['72px', { lineHeight: '1.2', fontWeight: '700' }],
        'hero-md': ['56px', { lineHeight: '1.2', fontWeight: '700' }],
        'h1': ['48px', { lineHeight: '1.2', fontWeight: '700' }],
        'h2': ['36px', { lineHeight: '1.3', fontWeight: '700' }],
        'h3': ['28px', { lineHeight: '1.3', fontWeight: '700' }],
        'h4': ['24px', { lineHeight: '1.4', fontWeight: '600' }],
        'h5': ['20px', { lineHeight: '1.4', fontWeight: '600' }],
        'h6': ['18px', { lineHeight: '1.5', fontWeight: '600' }],
        'body': ['16px', { lineHeight: '1.6' }],
        'body-sm': ['14px', { lineHeight: '1.5' }],
      },

      fontFamily: {
        'sans': ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        'display': ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },

      fontWeight: {
        thin: '100',
        extralight: '200',
        light: '300',
        normal: '400',
        medium: '500',
        semibold: '600',
        bold: '700',
        extrabold: '800',
        black: '900',
      },

      // Spacing System (8px base)
      spacing: {
        '0': '0',
        '1': '8px',
        '2': '16px',
        '3': '24px',
        '4': '32px',
        '5': '48px',
        '6': '64px',
        '7': '80px',
        '8': '96px',
        '9': '112px',
        '10': '128px',
      },

      // Gap
      gap: {
        '1': '8px',
        '2': '16px',
        '3': '24px',
        '4': '32px',
        '5': '48px',
        '6': '64px',
      },

      // Padding
      padding: {
        '1': '8px',
        '2': '16px',
        '3': '24px',
        '4': '32px',
        '5': '48px',
        '6': '64px',
      },

      // Border Radius
      borderRadius: {
        'none': '0px',
        'sm': '8px',
        'md': '12px',
        'lg': '16px',
        'xl': '20px',
        'pill': '9999px',
      },

      // Border Width
      borderWidth: {
        '0': '0px',
        '1': '1px',
        '2': '2px',
        '3': '3px',
        '4': '4px',
      },

      // Box Shadow
      boxShadow: {
        'card': '0 2px 8px rgba(0, 0, 0, 0.1)',
        'card-hover': '0 8px 16px rgba(0, 0, 0, 0.15)',
        'input': '0 1px 3px rgba(0, 0, 0, 0.1)',
      },

      // Aspect Ratio
      aspectRatio: {
        'hero': '1920 / 600',
        'card': '16 / 9',
        'square': '1 / 1',
        'portrait': '3 / 4',
      },

      // Animation
      animation: {
        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        'fade-in': 'fadeIn 0.3s ease-in-out',
      },

      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
      },

      // Transition
      transitionDuration: {
        '200': '200ms',
        '300': '300ms',
      },
    },
  },

  plugins: [
    // Custom component plugins
    require('tailwindcss/plugin')(function ({ addComponents, theme }) {
      const buttons = {
        '.btn': {
          '@apply inline-flex items-center justify-center font-semibold transition-all duration-200': {},
          '@apply border border-solid': {},
          '@apply h-10 px-4': {},
          '@apply cursor-pointer': {},
        },
        '.btn-primary': {
          '@apply bg-black text-white border-black': {},
          '@apply hover:bg-gray-800': {},
          '@apply active:scale-95': {},
        },
        '.btn-secondary': {
          '@apply bg-white text-black border-dashed border-black': {},
          '@apply hover:bg-gray-50': {},
          '@apply active:scale-95': {},
        },
        '.btn-outline': {
          '@apply bg-transparent text-black border-dashed border-black': {},
          '@apply hover:bg-gray-50': {},
          '@apply active:scale-95': {},
        },
        '.btn-pill': {
          '@apply rounded-pill px-6': {},
        },
        '.btn-sm': {
          '@apply h-8 px-3 text-sm': {},
        },
        '.btn-lg': {
          '@apply h-12 px-6 text-lg': {},
        },
        '.btn-disabled': {
          '@apply opacity-50 cursor-not-allowed': {},
        },

        // Card Components
        '.card': {
          '@apply rounded-lg border-4 bg-white overflow-hidden': {},
          '@apply transition-all duration-200': {},
        },
        '.card-hover': {
          '@apply hover:shadow-card-hover hover:scale-102': {},
        },
        '.card-gradient-border': {
          '@apply border-4': {},
          'background-image': 'linear-gradient(135deg, #E74C3C, #F39C12, #F1C40F, #27AE60, #3498DB, #8E44AD)',
          'background-clip': 'padding-box',
        },

        // Input Components
        '.input': {
          '@apply w-full h-10 px-3 rounded-md border border-solid border-black': {},
          '@apply focus:outline-none focus:ring-2 focus:ring-offset-0': {},
          '@apply transition-all duration-200': {},
          '@apply text-base': {},
        },
        '.input-focus': {
          '@apply ring-2 ring-black': {},
        },

        // Filter Tabs
        '.filter-tab': {
          '@apply px-4 py-2 rounded-md border-2 border-dashed border-black': {},
          '@apply transition-all duration-200 cursor-pointer': {},
          '@apply text-black bg-transparent': {},
        },
        '.filter-tab-active': {
          '@apply bg-black text-white border-solid border-black': {},
        },

        // Badge
        '.badge': {
          '@apply inline-block px-2 py-1 rounded-md text-xs font-semibold': {},
        },

        // Table Styling
        '.table': {
          '@apply w-full border-collapse': {},
        },
        '.table-row': {
          '@apply border-b border-gray-200': {},
          '@apply hover:bg-gray-50': {},
        },
        '.table-header': {
          '@apply bg-black text-white font-bold': {},
        },
        '.table-cell': {
          '@apply px-4 py-3 text-left': {},
        },
      };

      addComponents(buttons);
    }),
  ],
};
