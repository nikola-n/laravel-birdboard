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
        }
    },
  },
  variants: {},
  plugins: [],
}
