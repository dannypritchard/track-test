// branded type for isrc
export type ISRC = string & { __isrcBrand: never }

export type Track = {
  id: number
  title: string
  artist: string
  duration: number
  isrc: ISRC | null // value optional, i.e. can be null but key must exist
}
