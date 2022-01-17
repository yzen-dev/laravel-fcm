<?php

namespace LaravelFirebase;

use InvalidArgumentException;

/**
 *
 */
class FirebaseNotification
{
    /** @var null|string */
    private ?string $title;
    
    /** @var null|string */
    private ?string $body;
    
    /** @var null|string */
    private ?string $imageUrl;
    
    /**
     * @throws InvalidArgumentException if both title and body are null
     */
    public function __construct(?string $title = null, ?string $body = null, ?string $imageUrl = null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->imageUrl = $imageUrl;
        
        if ($this->title === null && $this->body === null) {
            throw new InvalidArgumentException('The title and body of a notification cannot both be NULL');
        }
    }
    
    /**
     * @throws InvalidArgumentException if both title and body are null
     */
    public static function create(?string $title = null, ?string $body = null, ?string $imageUrl = null): self
    {
        return new self($title, $body, $imageUrl);
    }
    
    /**
     * @param array $data
     *
     * @return FirebaseNotification
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'] ?? null,
            $data['body'] ?? null,
            $data['image'] ?? null
        );
    }
    
    /**
     * @param string $title
     *
     * @return $this
     */
    public function withTitle(string $title): self
    {
        $notification = clone $this;
        $notification->title = $title;
        
        return $notification;
    }
    
    /**
     * @param string $body
     *
     * @return $this
     */
    public function withBody(string $body): self
    {
        $notification = clone $this;
        $notification->body = $body;
        
        return $notification;
    }
    
    /**
     * @param string $imageUrl
     *
     * @return $this
     */
    public function withImageUrl(string $imageUrl): self
    {
        $notification = clone $this;
        $notification->imageUrl = $imageUrl;
        
        return $notification;
    }
    
    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * @return null|string
     */
    public function getBody(): ?string
    {
        return $this->body;
    }
    
    /**
     * @return null|string
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }
    
    /**
     * @return null[]|string[]
     */
    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'imageUrl' => $this->getImageUrl(),
        ];
    }
}
