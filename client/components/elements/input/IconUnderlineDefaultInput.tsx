import { FC } from 'react'

import { Input } from '@nextui-org/react'

import { IconInputType } from 'types/input'

export const IconUnderlineDefaultInput: FC<IconInputType> = ({ icon: Icon, placeholder }) => {
  return (
    <>
      <Input color='default' contentLeft={<Icon className='text-white' />} underlined placeholder={placeholder} />
    </>
  )
}
