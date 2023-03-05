module.exports = {
  root: true,
  extends: ['next/core-web-vitals', 'prettier', 'plugin:tailwindcss/recommended'],
  overrides: [
    {
      files: ['*.ts', '*.tsx', '*.js'],
      parser: '@typescript-eslint/parser',
    },
  ],
  rules: {
    'import/order': [
      'error',
      {
        groups: ['builtin', 'external', 'parent', 'sibling', 'index', 'object', 'type'],
        pathGroups: [
          {
            pattern: '{react,react-dom/**,react-router-dom}',
            group: 'builtin',
            position: 'before',
          },
          {
            pattern: '@src/**',
            group: 'parent',
            position: 'before',
          },
        ],
        pathGroupsExcludedImportTypes: ['builtin'],
        alphabetize: {
          order: 'asc',
        },
        'newlines-between': 'always',
      },
    ],
  },
}
