module.exports = {
  future: {
    // removeDeprecatedGapUtilities: true,
    // purgeLayersByDefault: true,
  },
  purge: [],
  theme: {
    extend: {
        shadows: {
            default:'0 0 5px 0 rgba(0, 0, 0, 0.08)',
        },
        colors: {
            'grey-light':'#F5F6F9',
            grey:'rgba(0, 0, 0, 0.4)',
            'blue-light':'#8ae2fe',
            default:'var(--text-default-color)',
            accent: 'var(--text-accent-color)',
            'accent-light': 'var(--text-accent-light-color)',
            muted: 'var(--text-muted-color)',
            'muted-light': 'var(--text-muted-light-color)',

        },
        backgroundColor: {
            page: 'var(--page-background-color)',
            cards: 'var(--cards-background-color)',
            button: 'var(--button-background-color)',
            header: 'var(--header-background-color)',
        },
    },
  },
  variants: {},
  plugins: [],
}
